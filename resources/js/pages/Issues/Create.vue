<script setup lang="ts">
import { Input } from '@/components/ui/input';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { useForm } from '@inertiajs/vue3';
import issueRoutes from '@/routes/issues';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create an Issue',
        href: '/projects/create',
    },
];

defineProps<{
    projects: {
        id: number
        title: string
    }[]
}>()

const form = useForm({
    title: '',
    description: '',
    status: 'open',
    project_id: '',
});

const handleSubmit = () => {
    form.post(issueRoutes.store().url);
};
</script>

<template>

    <Head title="Create Issue" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-8/12 space-y-4">
            <form @submit.prevent="handleSubmit">
                <div class="flex flex-col gap-4 p-4">
                    <Label for="issue-title">Issue Title</Label>
                    <Input id="issue-title" v-model="form.title" type="text" placeholder="Title"></Input>
                    <div class="text-sm text-red-600" v-if="form.errors.title">
                        {{ form.errors.title }}
                    </div>
                </div>
                <div class="flex flex-col gap-4 p-4">
                    <Label for="issue-description">Description</Label>
                    <Input id="issue-description" v-model="form.description" type="text"
                        placeholder="Write a short description..."></Input>
                    <div class='text-sm text-red-600' v-if="form.errors.description">{{ form.errors.description }}</div>
                </div>
                <div class="flex flex-col gap-4 p-4">
                    <Label for="issue-status">
                        Status
                    </Label>

                    <select id="issue-status" v-model="form.status" class="border rounded-md p-2 bg-black text-white">
                        <option value="open">
                            Open
                        </option>

                        <option value="in_progress">
                            In Progress
                        </option>

                        <option value="closed">
                            Closed
                        </option>
                    </select>

                    <div class="text-sm text-red-600" v-if="form.errors.status">
                        {{ form.errors.status }}
                    </div>
                </div>

                <div class="flex flex-col gap-4 p-4">
                    <Label for="issue-project">
                        Project
                    </Label>

                    <select id="issue-project" v-model="form.project_id" class="border rounded-md p-2 bg-black text-white">
                        <option disabled value="">
                            Select a project
                        </option>

                        <option v-for="project in projects" :key="project.id" :value="project.id">
                            {{ project.title }}
                        </option>
                    </select>

                    <div class="text-sm text-red-600" v-if="form.errors.project_id">
                        {{ form.errors.project_id }}
                    </div>
                </div>
                <div class="flex justify-end p-4">
                    <Button type="submit">Create Project</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>