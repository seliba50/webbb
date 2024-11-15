<form method="POST" action="{{ route('create-course') }}" class="bg-red-600 p-6 rounded-lg shadow-lg">
    @csrf

    <div class="sm:flex gap-3 max-[640px]:block">
        <div class="flex-1">
            <!-- Course name field -->
            <div>
                <x-input-label for="course_name" :value="__('Course name')" />
                <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name"
                    :value="old('course_name')" required autofocus />
                <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
            </div>
            <!-- Course code -->
            <div>
                <x-input-label for="course_code" :value="__('Course code')" />
                <x-text-input id="course_code" class="block mt-1 w-full" type="text" name="course_code"
                    :value="old('course_code')" required />
                <x-input-error :messages="$errors->get('course_code')" class="mt-2" />
            </div>
            <!-- Faculty -->
            <div>
                <x-input-label for="faculty" :value="__('Faculty')" />
                <select id="faculty" class="mt-1 w-full border-gray-300 rounded-md" name="faculty" :value="old('faculty')" required>
                    <option value="">Select faculty</option>
                    @if ($faculties)
                        @foreach ($faculties as $faculty)
                            <option value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                        @endforeach
                    @endif
                </select>
                <x-input-error :messages="$errors->get('level')" class="mt-2" />
            </div>
            <!-- Level -->
            <div>
                <x-input-label for="level" :value="__('Level')" />
                <x-text-input id="level" class="block mt-1 w-full" type="text" name="level" :value="old('level')"
                    required placeholder="Diploma or BSc" />
                <x-input-error :messages="$errors->get('level')" class="mt-2" />
            </div>
            <!-- Course duration -->
            <div>
                <x-input-label for="course_duration" :value="__('Course duration')" />
                <x-text-input id="course_duration" class="block mt-1 w-full" type="text" name="course_duration"
                    :value="old('course_duration')" placeholder="4 years" required />
                <x-input-error :messages="$errors->get('course_duration')" class="mt-2" />
            </div>
            <!-- Course price per annual -->
            <div>
                <x-input-label for="price" :value="__('Tuition fee (per annual)')" />
                <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')"
                    placeholder="M20,000.00" required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>
            <!-- Amount of passes -->
            <div>
                <x-input-label for="pass" :value="__('Amount of Passes')" />
                <x-text-input id="pass" class="block mt-1 w-full" type="number" name="pass" :value="old('pass')" />
                <x-input-error :messages="$errors->get('pass')" class="mt-2" />
            </div>
        </div>

        <div class="flex-1">
            <!-- Subjects to be passed -->
            <div>
                <x-input-label for="passed_subject" :value="__('Subjects to be passed')" />
                <x-text-input id="passed_subject" class="block mt-1 w-full" type="text" name="passed_subject"
                    :value="old('passed_subject')" placeholder="subjects with comma separated" />
                <x-input-error :messages="$errors->get('passed_subject')" class="mt-2" />
            </div>
            <!-- Amount of credits -->
            <div>
                <x-input-label for="credit_amount" :value="__('Amount of Credits')" />
                <x-text-input id="credit_amount" class="block mt-1 w-full" type="number" name="credit_amount" :value="old('credit_amount')" />
                <x-input-error :messages="$errors->get('credit_amount')" class="mt-2" />
            </div>
            <!-- Credited subjects -->
            <div>
                <x-input-label for="credits" :value="__('Credited Subjects')" />
                <x-text-input id="credits" class="block mt-1 w-full" type="text" name="credits" :value="old('credits')"
                    placeholder="subjects with comma separated" />
                <x-input-error :messages="$errors->get('credits')" class="mt-2" />
            </div>

            <!-- Description -->
            <div>
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" class="mt-1 w-full border-gray-300 rounded-md" name="description"
                    required>{{old('description')}}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <!-- Application requirements -->
            <div>
                <x-input-label for="requirements" :value="__('Application requirements')" />
                <textarea id="requirements" class="mt-1 w-full border-gray-300 rounded-md" name="requirements"
                    required>{{old('requirements')}}</textarea>
                <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
            </div>
        </div>
    </div>

    <div>
        <x-primary-button class="mt-3">
            {{ __('Add Course') }}
        </x-primary-button>
    </div>
</form>
