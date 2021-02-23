<x-success-message />

<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">{{ __('Profile Information') }}</h3>
    
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Update your account\'s profile information and email address.') }}
            </p>
        </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{route('profile.update', $user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <!-- Profile Photo File Input -->
                            <input type="file" name="book_photo" id="uploadBookPhoto" class="hidden" accept=".jpg, .png">
                            <input type="file" name="photo" id="uploadProfile" class="hidden" accept=".jpg, .png">
                            <input type="text" name="cropped_data" id="croppedData" class="hidden">
                
                            <!-- Book Photo -->
                            <div class="mt-2">
                                <label class="block font-medium text-sm text-gray-700" for="photo">{{ __("本の画像") }}</label>
                                @if ($user->book_photo_path)
                                    <div id="preview" class="">
                                        <img src="{{$user->book_photo_path}}">
                                    </div>
                                @else
                                    <div id="preview" class="hidden">
                                    </div>
                                @endif 
                                
                                <button id="uploadBookPhotoButton" class="mt-2 mr-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150" type="button">
                                    {{ __('画像を選択') }}
                                </button>

                                <x-error for="book_photo" class="mt-2" />
                            </div>


                            
                            <!-- Profile Photo -->
                            <div class="mt-2">
                                <label class="block font-medium text-sm text-gray-700" for="photo">{{ __('プロフィール画像') }}</label>
                                <img src="{{$user->profile_photo_path}}" alt="" id="cropperPreview" class="rounded-full h-20 w-20 object-cover">
                                <button id="uploadPhotoButton" class="mt-2 mr-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150" type="button">
                                    {{ __('画像を選択') }}
                                </button>
                            </div>
                
                            
                            <x-error for="photo" class="mt-2" />
                        </div>
                
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="name">{{ __('Name') }}</label>
                            <x-input id="name" type="text" name="name" value="{{$user->name}}" class="mt-1 block w-full" />
                            <x-error for="name" class="mt-2" />
                        </div>
                
                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="email">{{ __('Email') }}</label>
                            <x-input id="email" type="email" name="email" value="{{$user->email}}" class="mt-1 block w-full" />
                            <x-error for="email" class="mt-2" />
                        </div>

                        <!-- Info -->
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="info">{{ __('紹介文(128文字以内)') }}</label>
                            <x-textarea name="info" id="info" rows="7" class="mt-1 block w-full resize-none text-sm">
                                {{$user->info}}
                            </x-textarea>
                            <x-error for="info" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>    

@push('modals')
    <!-- modal -->
<div class="modal fade" id="cropperModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">トリミング</h5>
            </div>
            <div class="modal-body">
                <div class="cropper-img-container">
                    <img id="cropperImage" src="" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="crop" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endpush
