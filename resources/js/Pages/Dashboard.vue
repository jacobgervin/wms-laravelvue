<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WarehouseList from '@/Components/WarehouseList.vue';


</script>

<template>
    <Head title="Materialer" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Materialer</h2>
        </template>
         <WarehouseList></WarehouseList>
    </AuthenticatedLayout>
</template>
<script>

</script>
