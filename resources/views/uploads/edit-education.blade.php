<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Education') }}
                            </h2>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('education.update', ['education' => $education->id]) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                
                                <select style="background-color: rgb(17 24 39); color: #ffffff;" name="status" :value="old('status', $education->status)" required>
                                    <option {{ (old('status', $education->status) == 1) ? 'selected' : '' }} value="1">Currently Attending</option>
                                    <option {{ (old('status', $education->status) == 0) ? 'selected' : '' }} value="0">Graduated</option>                                   
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                @error('status')<p class="error">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <x-input-label for="date" :value="__('Date Entered - Date Left/(Present)')" />
                                <x-text-input id="date" name="date" type="text" class="mt-1 block w-full" required autocomplete="date" :value="old('date', $education->date)" />
                                <x-input-error class="mt-2" :messages="$errors->get('date')" />
                            </div>

                            <div>
                                <x-input-label for="course" :value="__('Course')" />
                                <x-text-input id="course" name="course" type="text" class="mt-1 block w-full" required autocomplete="course" :value="old('course', $education->course)" />
                                <x-input-error class="mt-2" :messages="$errors->get('course')" />
                            </div>

                            <div>
                                <x-input-label for="school" :value="__('School')" />
                                <x-text-input id="school" name="school" type="text" class="mt-1 block w-full" required autocomplete="school" :value="old('course', $education->school)" />
                                <x-input-error class="mt-2" :messages="$errors->get('school')" />
                            </div>

                            <div>
                                <x-input-label for="activity" :value="__('Activity')" />
                                <textarea style="background-color: rgb(17 24 39); color: #ffffff;" id="activity" name="activity" class="mt-1 block w-full" required autofocus autocomplete="activity">{{ $education->activity }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('activity')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update Education') }}</x-primary-button>

                                @if (session('status') === 'education-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Education Added!') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
