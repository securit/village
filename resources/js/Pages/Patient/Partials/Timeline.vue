<template>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Timeline of Notes.
            </h3>
        </div>
        <div class="border-t border-gray-200">
            <div class="relative wrap overflow-hidden p-10 h-full">
                <div class="border-2-2 absolute border-opacity-20 border-gray-700 h-full border" style="left: 50%"></div>
                <!-- right timeline -->
                <div v-for="(note,index) of notes" class="mb-8 flex justify-between items-center w-full right-timeline">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center order-1 bg-gray-800 shadow-xl w-8 h-8 rounded-full">
                        <h1 class="mx-auto font-semibold text-lg text-white">{{ index + 1 }}</h1>
                    </div>
                    <div class="order-1 bg-gray-200 rounded-lg shadow-xl w-5/12 px-6 py-4">
                        <div class="text-xs text-grey flex items-center my-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="h-4 w-4 mr-1 feather feather-calendar">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <p class="text-sm leading-snug tracking-wide text-gray-900 text-opacity-100">{{ localDate(note.created_at) }}</p>
                        </div>
                        <h3 class="mb-3 font-bold text-gray-800 text-xl">{{ note.title }}</h3>
                        <p class="text-sm leading-snug tracking-wide text-gray-900 text-opacity-100">{{ note.note }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import FormSection from "@/Shared/FormSection"

const locale = navigator.languages && navigator.languages.length ? navigator.languages[0] : navigator.userLanguage ? navigator.userLanguage : navigator.language

export default {
    props:      ['notes'],
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
    methods:    {
        fromNow(date) {
            if (typeof Intl.RelativeTimeFormat === 'undefined') return
            const units = {
                year:   3.1536e10,
                month:  2.628e9,
                day:    8.64e7,
                hour:   3.6e6,
                minute: 6e4,
                second: 1000
            }

            let rtf = new Intl.RelativeTimeFormat(locale, {numeric: 'auto'})

            let getRelativeTime = (d1, d2 = new Date()) => {
                let elapsed = d1 - d2

                // 'Math.abs' accounts for both 'past' & 'future' scenarios
                for (let u in units) if (Math.abs(elapsed) > units[u] || u === 'second') return rtf.format(Math.round(elapsed / units[u]), u)
            }

            return getRelativeTime(+new Date(date))
        },
        localDate(value) {
            const date    = new Date(value)
            const options = {dateStyle: 'short', timeStyle: 'short'}

            return new Intl.DateTimeFormat(locale, options).format(date)
        },
    }
}
</script>
