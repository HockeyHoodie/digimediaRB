<script setup lang="ts">
import { Input } from '@/components/ui/input';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';  
import { useForm } from '@inertiajs/vue3';
import projectRoutes from '@/routes/projects';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create a Project',
        href: '/projects/create',
    },
];

const form = useForm({
    title: '',
    description: '',
});

const handleSubmit = () => {
    form.post(projectRoutes.store().url);
};
</script>

<template>
    <Head title="Create Project" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-8/12 space-y-4">
            <form @submit.prevent="handleSubmit">
                <div class="flex flex-col gap-4 p-4">
                    <Label for="project-title">Project Title</Label>
                    <Input
                        id="project-title"
                        v-model="form.title"
                        type="text"
                        placeholder="Title"
                    ></Input>
                    <div class="text-sm text-red-600" v-if="form.errors.title">
                        {{ form.errors.title }}
                    </div>
                </div>
                <div class="flex flex-col gap-4 p-4">
                    <Label for="project-description">Description</Label>
                    <Input id="project-description" v-model="form.description" type="text" placeholder="Write a short description..."></Input>
                    <div class='text-sm text-red-600' v-if="form.errors.description">{{ form.errors.description }}</div>
                </div>
                <div class="flex justify-end p-4">
                    <Button type="submit">Create Project</Button>
                    </div>
            </form>
        </div>
    </AppLayout>
</template>