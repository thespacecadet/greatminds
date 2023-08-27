<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import Follower from "@/Components/Follower.vue";

defineProps(['followers']);

</script>

<template>
    <Head title="Followers"><title>Followers</title></Head>
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <h3>Your Followers</h3>
                <Follower
                    v-for="follower in followers.data"
                    :key="follower.id"
                    :follower="follower"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    name: "Index"
}
</script>

<style scoped>

</style>
