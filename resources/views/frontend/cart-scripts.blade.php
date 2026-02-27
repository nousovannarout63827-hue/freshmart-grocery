    @push('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        console.log('Cart page loaded, CSRF token:', csrfToken ? 'found' : 'NOT FOUND');

        // Update Quantity with AJAX (Reloads page to update totals)
        function updateQuantityAjax(productId, quantity) {
            console.log('Updating quantity for product', productId, 'to', quantity);

            if (quantity < 1) {
                if (!confirm('Remove this item from cart?')) return;
                removeItemAjax(productId);
                return;
            }

            const quantityInput = document.getElementById(`quantity-${productId}`);
            const originalValue = quantityInput.value;

            // Show loading state
            quantityInput.disabled = true;
            quantityInput.value = '...';

            fetch('{{ route("cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-HTTP-Method-Override': 'PUT',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: parseInt(quantity)
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                if (data.success) {
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to update quantity',
                        iconColor: '#dc2626',
                        confirmButtonColor: '#16a34a'
                    });
                    quantityInput.value = originalValue;
                    quantityInput.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                    iconColor: '#dc2626',
                    confirmButtonColor: '#16a34a'
                });
                quantityInput.value = originalValue;
                quantityInput.disabled = false;
            });
        }

        // Remove Item with AJAX (No Refresh - Smooth Animation)
        function removeItemAjax(productId) {
            console.log('Removing item', productId);

            const cartItem = document.getElementById(`cart-item-${productId}`);
            console.log('Cart item element:', cartItem);

            if (!cartItem) {
                console.error('Cart item not found!');
                return;
            }

            if (!confirm('Remove this item from your cart?')) {
                return;
            }

            fetch('{{ url('cart/remove') }}/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-HTTP-Method-Override': 'DELETE',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ _method: 'DELETE' })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);

                if (data.success) {
                    // Show success toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Removed!',
                        text: 'Item has been removed from your cart',
                        iconColor: '#16a34a',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        background: '#f0fdf4',
                        color: '#166534'
                    });

                    // Animate and remove
                    cartItem.style.transition = 'all 0.3s ease';
                    cartItem.style.opacity = '0';
                    cartItem.style.transform = 'translateX(-20px)';
                    cartItem.style.maxHeight = '0';
                    cartItem.style.padding = '0';
                    cartItem.style.margin = '0';
                    cartItem.style.overflow = 'hidden';

                    setTimeout(() => {
                        cartItem.remove();

                        // Update cart count
                        if (data.cart_count !== undefined) {
                            updateCartCountDisplay(data.cart_count);
                        }

                        // Update totals
                        updateCartTotals();

                        // Reload if empty
                        const remainingItems = document.querySelectorAll('[id^="cart-item-"]');
                        if (remainingItems.length === 0) {
                            setTimeout(() => location.reload(), 500);
                        }
                    }, 300);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                    iconColor: '#dc2626',
                    confirmButtonColor: '#16a34a'
                });
            });
        }

        // Update Cart Count Display
        function updateCartCountDisplay(count) {
            const cartCountElements = document.querySelectorAll('#cart-count, .cart-count');
            cartCountElements.forEach(el => {
                el.style.transition = 'all 0.3s ease';
                el.style.transform = 'scale(1.3)';
                setTimeout(() => {
                    el.textContent = count;
                    el.style.transform = 'scale(1)';
                    el.classList.remove('hidden');
                }, 150);
            });
        }

        // Update Cart Totals
        function updateCartTotals() {
            let subtotal = 0;

            document.querySelectorAll('[id^="cart-item-"]').forEach(item => {
                const priceText = item.querySelector('.text-2xl.font-bold').textContent.replace('$', '');
                subtotal += parseFloat(priceText);
            });

            // Update subtotal
            const subtotalEl = document.querySelector('.flex.justify-between.text-gray-600 .font-medium');
            if (subtotalEl) {
                subtotalEl.textContent = '$' + subtotal.toFixed(2);
            }

            // Update delivery
            const deliveryFee = (subtotal >= 50.00) ? 0 : 6.00;
            const deliveryEl = document.querySelector('.flex.justify-between.text-gray-600 .font-medium');
            if (deliveryEl) {
                if (deliveryFee === 0) {
                    deliveryEl.textContent = 'FREE';
                    deliveryEl.className = 'font-bold text-green-600';
                } else {
                    deliveryEl.textContent = '$' + deliveryFee.toFixed(2);
                    deliveryEl.className = 'font-medium text-gray-800';
                }
            }

            // Update total
            const totalEl = document.querySelector('.text-primary-600');
            if (totalEl) {
                totalEl.textContent = '$' + (subtotal + deliveryFee).toFixed(2);
            }

            // Update progress
            const progressEl = document.querySelector('.bg-amber-50, .bg-green-50');
            if (progressEl) {
                const amountNeeded = 50.00 - subtotal;
                if (amountNeeded > 0) {
                    progressEl.className = 'bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6';
                    progressEl.innerHTML = `<p class="text-amber-800 text-sm"><span class="font-semibold">💡 Tip:</span> Add $${amountNeeded.toFixed(2)} more to get <strong>FREE delivery</strong>!</p>`;
                } else {
                    progressEl.className = 'bg-green-50 border border-green-200 rounded-xl p-4 mb-6';
                    progressEl.innerHTML = `<p class="text-green-800 text-sm"><span class="font-semibold">🎉 Awesome!</span> You qualify for <strong>FREE standard delivery</strong>!</p>`;
                }
            }
        }
    </script>
    @endpush
@endsection
