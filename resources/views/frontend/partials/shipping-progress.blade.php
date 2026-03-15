<div id="shipping-progress" class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
    <p class="text-amber-800 text-sm">
        <span class="font-semibold">💡 {{ __('messages.tip') }}:</span> {{ __('messages.add_more_for_free_delivery', ['amount' => '$' . number_format($amountNeeded, 2)]) }}
    </p>
</div>
