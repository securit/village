<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update Patient
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <form-section @submitted="updatePatient" class="mb-3">
                    <template #form>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Please fill in the details for {{ patient.first_name }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    <!--Description about the do's and don'ts while editing the form below-->
                                </p>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            <jet-label for="first_name" value="Patient First Name" />
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <jet-input type="text" id="first_name" class="mt-1 block w-full" v-model="form.first_name" ref="first_name" autocomplete="first_name" />
                                            <jet-input-error :message="form.errors.first_name" class="mt-2" />
                                        </dd>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            <jet-label for="first_name" value="Patient Last Name" />
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <jet-input type="text" id="last_name" class="mt-1 block w-full" v-model="form.last_name" ref="last_name" autocomplete="last_name" />
                                            <jet-input-error :message="form.errors.last_name" class="mt-2" />
                                        </dd>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            <jet-label for="known_as" value="Also known as" />
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <jet-input type="text" id="known_as" class="mt-1 block w-full" v-model="form.known_as" ref="known_as" autocomplete="known_as" />
                                            <jet-input-error :message="form.errors.known_as" class="mt-2" />
                                        </dd>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            <jet-label for="title" value="Title" />
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
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </jet-action-message>

                        <Link :href="route('patients.index')"
                              class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                            Back
                        </Link>

                        <jet-danger-button class="ml-3" @click="confirmPatientDeletion" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Delete
                        </jet-danger-button>

                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="ml-3">
                            Save
                        </jet-button>

                        <!-- Delete Patient Confirmation Modal -->
                        <jet-confirmation-modal :show="confirmingPatientDeletion" @close="confirmingPatientDeletion = false">
                            <template #title>
                                Delete Patient
                            </template>

                            <template #content>
                                Are you sure you want to delete this patient?
                            </template>

                            <template #footer>
                                <jet-secondary-button @click="confirmingPatientDeletion = false">
                                    Cancel
                                </jet-secondary-button>

                                <jet-danger-button class="ml-2" @click="deletePatient" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Delete Patient
                                </jet-danger-button>
                            </template>
                        </jet-confirmation-modal>
                    </template>
                </form-section>
                <jet-section-border />

                <add-note-form class="mt-10 sm:mt-0" :patient_id="patient.id"/>

                <jet-section-border />

                <timeline class="mt-10 sm:mt-0" :notes="patient.notes"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import FormSection from '@/Shared/FormSection'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetSectionBorder from '@/Jetstream/SectionBorder'
import {Head, Link} from '@inertiajs/inertia-vue3'
import AddNoteForm from '@/Pages/Patient/Partials/AddNoteForm'
import Timeline from "@/Pages/Patient/Partials/Timeline"


export default {
    props:      [
        'patient',
    ],
    components: {
        Timeline,
        AddNoteForm,
        AppLayout,
        FormSection,
        Head,
        JetActionMessage,
        JetButton,
        JetConfirmationModal,
        JetDangerButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetSectionBorder,
        Link
    },
    data() {
        return {
            form:
                this.$inertia.form({
                first_name: this.patient.first_name,
                known_as:   this.patient.known_as,
                last_name:  this.patient.last_name,
                title:      this.patient.title,
            }),
            confirmingPatientDeletion: false,
        };
    },
    methods: {
        updatePatient() {
            this.confirmingPatientDeletion = false;
            this.form.put(route('patients.update', this.patient.id), {
                errorBag: 'updatePatient',
            })
        },
        confirmPatientDeletion() {
            this.confirmingPatientDeletion = true;
        },
        deletePatient() {
            this.confirmingPatientDeletion = false;
            this.form.delete(route('patients.destroy', this.patient.id), {
                errorBag: 'destroyPatient',
            })
        },
    },
}
</script>
