<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Patient
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <form-section @submitted="updatePatient" class="mb-3">
                    <template #form>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Please fill in the details for the new patient
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    <!--Description about the do's and don'ts while editing the form below-->
                                </p>
                            </div>
                            <!-- https://html.spec.whatwg.org/multipage/form-control-infrastructure.html#attr-fe-autocomplete-street-address -->
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            <jet-label for="name" value="Patient First Name" />
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <jet-input type="text" id="first_name" class="mt-1 block w-full" v-model="form.first_name" ref="first_name" autocomplete="first_name" />
                                            <jet-input-error :message="form.errors.first_name" class="mt-2" />
                                        </dd>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            <jet-label for="name" value="Patient Last Name" />
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <jet-input type="text" id="last_name" class="mt-1 block w-full" v-model="form.last_name" ref="last_name" autocomplete="last_name" />
                                            <jet-input-error :message="form.errors.last_name" class="mt-2" />
                                        </dd>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            <jet-label for="name" value="Patient Known As" />
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <jet-input type="text" id="known_as" class="mt-1 block w-full" v-model="form.known_as" ref="first_name" autocomplete="known_as" />
                                            <jet-input-error :message="form.errors.known_as" class="mt-2" />
                                        </dd>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            <jet-label for="name" value="Title" />
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <jet-input type="text" id="title" class="mt-1 block w-full" v-model="form.title" ref="title" autocomplete="title" />
                                            <jet-input-error :message="form.errors.title" class="mt-2" />
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </template>

                    <template #actions>
                        <Link :href="route('patients.index')"
                              class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                            Back
                        </Link>

                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="ml-3">
                            Save
                        </jet-button>
                    </template>
                </form-section>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import FormSection from '@/Shared/FormSection'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'
import {Head, Link} from '@inertiajs/inertia-vue3'

export default {
    components: {
        AppLayout,
        JetActionMessage,
        JetButton,
        FormSection,
        Head,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetDangerButton,
        Link,
    },
    data() {
        return {
            form: this.$inertia.form({
                birthday:   '',
                first_name: '',
                gender:     '',
                known_as:   '',
                last_name:  '',
                title:      '',
            }),
        }
    },
    methods: {
        updatePatient() {
            this.form.post(route('patients.store'), {
                errorBag: 'createPatient',
            });
        },
    },
}
</script>
