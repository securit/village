<template>
    <form-section @submitted="createNote" class="mb-3">

        <template #form>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Add a note to this patient.
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        <!--Description about the do's and dont's while editing the form below-->
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                <jet-label for="title" value="Title" />
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" autocomplete="title" />
                                <jet-input-error :message="form.errors.title" class="mt-2" />
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                <jet-label for="note" value="Note" />
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <!--jet-input id="note" type="textarea" rows="4" class="mt-1 block w-full" v-model="form.note" /-->
                                <textarea class="mt-1 block w-full" rows="4" v-model="form.note"></textarea>
                                <jet-input-error :message="form.errors.note" class="mt-2" />
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

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </form-section>
</template>

<script>
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import FormSection from "@/Shared/FormSection";

export default {
    components: {
        FormSection,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },

    props: ['patient_id'],

    data() {
        return {
            form: this.$inertia.form({
                patient_id: this.patient_id,
                title:      this.title,
                note:       this.note,
            }),
        }
    },

    methods: {
        createNote() {
            this.form.post(route('notes.store'), {
                errorBag:  'createNote',
                onSuccess: () => this.$inertia.reload()
            });
        },
    },
}
</script>
