<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- User Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="username" value="{{ __('User Name') }}" />
            <x-jet-input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.username" autocomplete="username" />
            <x-jet-input-error for="username" class="mt-2" />
        </div>

        <!-- Bio -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="bio" value="{{ __('Bio') }}" />
            <x-jet-input id="bio" type="text" class="mt-1 block w-full" wire:model.defer="state.bio" autocomplete="bio" />
            <x-jet-input-error for="bio" class="mt-2" />
        </div>

        <!-- URL -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="url" value="{{ __('Url') }}" />
            <x-jet-input id="url" type="text" class="mt-1 block w-full" wire:model.defer="state.url" autocomplete="url" />
            <x-jet-input-error for="url" class="mt-2" />
        </div>

         <!-- Status -->
         <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="status" value="{{ __('Status') }}" />
            <select  id="status" name="status" class="mt-1 block w-full form-input rounded-md shadow-sm" wire:model.defer="state.status">
                <option value="public">{{__('Public')}}</option>
                <option value="private">{{__('Private')}}</option>
            </select>
            <x-jet-input-error for="status" class="mt-2" />
        </div>

        <!-- Language -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="language" value="{{ __('Language') }}" />
            <select  id="language" name="language" class="mt-1 block w-full form-input rounded-md shadow-sm" wire:model.defer="state.language">
                <option value="ar">{{__('Arabic')}}</option>
                <option value="en">{{__('English')}}</option>
            </select>
            <x-jet-input-error for="language" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
