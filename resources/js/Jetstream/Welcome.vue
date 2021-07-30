<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <jet-application-logo class="block h-12 w-auto" />
            </div>

            <div class="mt-8 text-2xl">
                Village is built on Laravel Jetstream leveraging its Login, registration, email verification, two-factor authentication
                and session management framework.
            </div>

            <div class="mt-6 text-gray-500">
                The Front-end is developed in InertiaJS using Vue3 using the backwards compatibility with
                Vue 2 rather than the composition API because it was just a little faster for me to do so.
            </div>

            <div class="mt-6 text-gray-500">
                <p>To Create/edit/delete patients click on
                    <Link :href="route('patients.index')" class="text-base font-medium text-indigo-500 hover:text-gray-900" :active="route().current('patients.index')">Patients</Link>.
                </p>
                <p>To Create a note, click on a patients name and enter the text you want in the Add a Note to this patient.</p>
                <p>The notes timeline is beneath the Add a note section</p>
            </div>

            <div class="mt-6 text-gray-500">
                Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
                to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
                you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
                ecosystem to be a breath of fresh air. We hope you love it.
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">

        </div>
    </div>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        JetApplicationLogo,
        Link
    },
}
</script>
