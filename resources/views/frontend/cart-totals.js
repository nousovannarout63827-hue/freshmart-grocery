        // Update Cart Totals Dynamically
        function updateCartTotals() {
            console.log('Updating cart totals...');
            let subtotal = 0;

            // Calculate subtotal from all cart items
            document.querySelectorAll('[id^="cart-item-"]').forEach(item => {
                const priceText = item.querySelector('.text-2xl.font-bold');
                if (priceText) {
                    const itemTotal = parseFloat(priceText.textContent.replace('$', ''));
                    subtotal += itemTotal;
                }
            });

            console.log('Calculated subtotal:', subtotal);

            // Find Order Summary section
            const summarySection = document.querySelector('.lg\\:col-span-1');
            if (!summarySection) {
                console.warn('Order summary section not found!');
                return;
            }

            // Update subtotal (first row in summary)
            const summaryRows = summarySection.querySelectorAll('.flex.justify-between');
            if (summaryRows.length > 0) {
                // Subtotal is typically the first or second row
                for (let i = 0; i < summaryRows.length; i++) {
                    const row = summaryRows[i];
                    if (row.textContent.includes('Subtotal')) {
                        const subtotalEl = row.querySelectorAll('span')[1] || row.querySelector('.font-medium');
                        if (subtotalEl) {
                            subtotalEl.textContent = '$' + subtotal.toFixed(2);
                            console.log('Updated subtotal:', subtotalEl.textContent);
                            break;
                        }
                    }
                }
                
                // Delivery fee
                for (let i = 0; i < summaryRows.length; i++) {
                    const row = summaryRows[i];
                    if (row.textContent.includes('Delivery')) {
                        const deliveryEl = row.querySelectorAll('span')[1] || row.querySelector('.font-medium, .text-green-600');
                        const deliveryFee = (subtotal >= 50.00) ? 0 : 6.00;
                        if (deliveryEl) {
                            if (deliveryFee === 0) {
                                deliveryEl.textContent = 'FREE';
                                deliveryEl.className = 'font-bold text-green-600';
                            } else {
                                deliveryEl.textContent = '$' + deliveryFee.toFixed(2);
                                deliveryEl.className = 'font-medium text-gray-800';
                            }
                            console.log('Updated delivery:', deliveryEl.textContent);
                            break;
                        }
                    }
                }
            }

            // Calculate discount if exists
            let discount = 0;
            const discountRow = summarySection.querySelector('.bg-green-50');
            if (discountRow) {
                const discountEl = discountRow.querySelector('.font-medium');
                if (discountEl) {
                    discount = parseFloat(discountEl.textContent.replace('$', ''));
                }
            }

            // Update total
            const deliveryFee = (subtotal >= 50.00) ? 0 : 6.00;
            const finalTotal = subtotal + deliveryFee - discount;
            const totalEl = summarySection.querySelector('.text-primary-600');
            if (totalEl) {
                totalEl.textContent = '$' + finalTotal.toFixed(2);
                console.log('Updated total:', totalEl.textContent);
            }

            // Update free shipping progress
            const progressEl = summarySection.querySelector('.bg-amber-50, .bg-green-50');
            if (progressEl) {
                const amountNeeded = 50.00 - subtotal;
                if (amountNeeded > 0) {
                    progressEl.className = 'bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6';
                    progressEl.innerHTML = `
                        <p class="text-amber-800 text-sm">
                            <span class="font-semibold">💡 Tip:</span> Add $${amountNeeded.toFixed(2)} more to get <strong>FREE delivery</strong>!
                        </p>
                    `;
                } else {
                    progressEl.className = 'bg-green-50 border border-green-200 rounded-xl p-4 mb-6';
                    progressEl.innerHTML = `
                        <p class="text-green-800 text-sm">
                            <span class="font-semibold">🎉 Awesome!</span> You qualify for <strong>FREE standard delivery</strong>!
                        </p>
                    `;
                }
            }
            
            console.log('Cart totals updated successfully');
        }
