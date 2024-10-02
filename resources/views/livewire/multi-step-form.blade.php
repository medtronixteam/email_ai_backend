<div style="width: 100%">
    <!-- Loading Overlay -->
    <div wire:loading   class="loading-overlay w-100 h-100">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <img src="{{ url('logo/single.png') }}" width="125" class="loading-overlay-img" alt="">
        </div>
    </div>

    <!-- Step 1: Name and Email -->
    @if(session()->has('message'))
        <div class="alert bg-primary">
            {{ session('message') }}
        </div>
    @endif
    <div wire:loading.remove>
        @if($currentStep == 1)
            <div class="form__step ">
                <div class="form__group">
                    <input type="text" wire:model="name" class="form__input" placeholder="Name">
                    @error('name') <span class="text-white">{{ $message }}</span> @enderror
                </div>
                <div class="form__group">
                    <input type="email" wire:model="email" class="form__input" placeholder="Email">
                    @error('email') <span class="text-white">{{ $message }}</span> @enderror
                </div>
                <button type="button" class="form__btn" wire:click="nextStep" wire:loading.attr="disabled">
                    Next
                </button>
            </div>
        @endif

        <!-- Step 2: Country and Date of Birth -->
        @if($currentStep == 2)
            <div class="form__step">
                <div class="form__group">
                    <input type="text" wire:model="country" class="form__input" placeholder="Country">
                    @error('country') <span class="text-white">{{ $message }}</span> @enderror
                </div>
                <div class="form__group">
                    <input type="date" wire:model="date_of_birth" class="form__input" placeholder="Date of Birth">
                    @error('date_of_birth') <span class="text-white">{{ $message }}</span> @enderror
                </div>
                <button type="button" class="form__btn" wire:click="nextStep" wire:loading.attr="disabled">
                    Next
                </button>
                <button type="button" class="form__btn" wire:click="previousStep" wire:loading.attr="disabled">
                    Back
                </button>
            </div>
        @endif

        <!-- Step 3: Password and Agreement -->
        @if($currentStep == 3)
            <div class="form__step">
                <div class="form__group">
                    <input type="text" wire:model="username" class="form__input" placeholder="Username">
                    @error('username') <span class="text-white">{{ $message }}</span> @enderror
                </div>
                <div class="form__group">
                    <input type="password" wire:model="password" class="form__input" placeholder="Password">
                    @error('password') <span class="text-white">{{ $message }}</span> @enderror
                </div>
                <div class="form__group form__group--checkbox">
                    <input id="remember" name="remember" type="checkbox">
                    <label for="remember">I agree to the <a href="#">Privacy Policy</a></label>
                </div>
                <button type="button" class="form__btn" wire:click="submit" wire:loading.attr="disabled">
                    Sign up
                </button>
                <button type="button" class="form__btn" wire:click="previousStep" wire:loading.attr="disabled">
                    Back
                </button>

            </div>
        @endif
    </div>
</div>
