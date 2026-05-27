<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import projectRoutes from '@/routes/projects';

interface Project {
    id: number;
    title: string;
    description: string | null;
    created_at: string;
}

withDefaults(
    defineProps<{
        projects?: Project[];
    }>(),
    {
        projects: () => [],
    },
);

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Projects',
                href: projectRoutes.index(),
            },
        ],
    },
});
</script>

<template>

    <Head title="Projects" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    Projects
                </h1>
                <p class="text-muted-foreground text-sm">
                    Manage your projects and their issues.
                </p>
            </div>

            <Link :href="projectRoutes.create()">
                <Button>Create project</Button>
            </Link>
        </div>

        <div
            class="relative flex-1 overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead class="text-right">Actions</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <TableRow v-for="project in projects" :key="project.id">
                        <TableCell class="font-medium">
                            {{ project.title }}
                        </TableCell>

                        <TableCell>
                            {{ project.description ?? '—' }}
                        </TableCell>

                        <TableCell class="space-x-2 text-right">
                            <Link :href="projectRoutes.edit(project.id)">
                                <Button variant="outline" size="sm">
                                    Edit
                                </Button>
                            </Link>
                        </TableCell>
                    </TableRow>

                    <TableRow v-if="projects.length === 0">
                        <TableCell colspan="5" class="text-muted-foreground h-24 text-center">
                            No projects yet.
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </div>
</template>
