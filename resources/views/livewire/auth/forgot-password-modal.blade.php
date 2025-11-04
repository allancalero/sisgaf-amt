<div>
    <flux:input wire:model.lazy="email" name="email" type="email" :label="__('Email')" required placeholder="email@example.com" />

    <div class="mt-4 flex justify-end gap-2">
        <flux:button type="button" variant="secondary" onclick="window.dispatchEvent(new CustomEvent('modal-close',{detail:{name:'forgot-password'}}))">{{ __('Cancelar') }}</flux:button>
        <flux:button wire:click.prevent="send" type="button" variant="primary">{{ __('Enviar enlace') }}</flux:button>
    </div>

    @if($errors->has('email'))
        <flux:text class="text-red-600 text-sm mt-2">{{ $errors->first('email') }}</flux:text>
    @endif
</div>
