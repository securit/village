<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Patient Register
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <flash class="mb-3" />
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-6 bg-white border-b border-gray-200">
                        <div class="mb-6 flex justify-between right">
                            <Link :href="route('patients.create')"
                                  class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                                <span>Create</span><span class="hidden md:inline">&nbsp;Patient</span>
                            </Link>
                        </div>
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    First Name
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Last Name
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Known As
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Title
                                                </th>
                                                <th scope="col" class="px-1 py-3">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="patient in patients.data" :key="patient.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                                <td class="px-6 whitespace-nowrap">
                                                    <Link class="px-6 flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                                                        <div class="text-sm text-gray-900">
                                                            {{ patient.last_name }}
                                                        </div>
                                                    </Link>
                                                </td>
                                                <td class="px-6 whitespace-nowrap">
                                                    <Link class="px-6 flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                                                        <div class="text-sm text-gray-900">
                                                            {{ patient.first_name }}
                                                        </div>
                                                    </Link>
                                                </td>
                                                <td class="px-6 whitespace-nowrap">
                                                    <Link class="px-6 flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                                                        <div class="text-sm text-gray-900">
                                                            {{ patient.known_as }}
                                                        </div>
                                                    </Link>
                                                </td>
                                                <td class="px-6 whitespace-nowrap">
                                                    <Link class="px-6 flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                                                        <div class="text-sm text-gray-900">
                                                            {{ patient.title }}
                                                        </div>
                                                    </Link>
                                                </td>
                                                <td class="px-1 whitespace-nowrap text-right text-sm font-medium">
                                                    <Link :href="route('patients.edit', patient.id)"
                                                          class="inline-flex items-center px-1 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-300 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                                        <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                                                    </Link>
                                                </td>
                                            </tr>
                                            <tr v-if="patients.data.length === 0">
                                                <td class="border-t px-6 py-4" colspan="4">No patients found.</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <pagination class="mt-6" :links="patients.links" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Flash from '@/Shared/Flash'
import Icon from '@/Shared/Icon'
import JetButton from '@/Jetstream/Button'
import Pagination from '@/Shared/Pagination'
import mapValues from 'lodash/mapValues'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Flash,
        Icon,
        JetButton,
        Link,
        Pagination,
    },
    props:      {
        patients: Object,
    },
    watch:      {
        form: {
            deep:    true,
            handler: throttle(function () {
                this.$inertia.get(this.route('patients'), pickBy(this.form), {preserveState: true})
            }, 150),
        },
    },
    methods:    {
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },
}
</script>
