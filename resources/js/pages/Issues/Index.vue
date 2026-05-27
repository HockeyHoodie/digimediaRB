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
import issueRoutes from '@/routes/issues';

interface Issue {
    id: number;
    title: string;
    description: string | null;
    status: string;
    created_at: string;
    project: {
    id: number;
    title: string;
    };
}

withDefaults(
    defineProps<{
        issues?: Issue[];
        projects: {
        id: number
        title: string
    }[]
    }>(),
    {
        issues: () => [],
    },
);



defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Issues',
                href: issueRoutes.index(),
            },
        ],
    },
});
</script>

<template>

    <Head title="Issues" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    Issues
                </h1>
                <p class="text-muted-foreground text-sm">
                    Manage your issues.
                </p>
            </div>

            <Link :href="issueRoutes.create()">
                <Button>Create issue</Button>
            </Link>
        </div>

        <div
            class="relative flex-1 overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Title</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Assigned Project</TableHead>
                        <TableHead class="text-right">Actions</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <TableRow v-for="issue in issues" :key="issue.id">
                        <TableCell class="font-medium">
                            {{ issue.title }}
                        </TableCell>

                        <TableCell>
                            {{ issue.description ?? '—' }}
                        </TableCell>

                        <TableCell>
                            {{ issue.status }}
                        </TableCell>

                        <TableCell>
                            {{ issue.project?.title }}
                        </TableCell>

                        <TableCell class="space-x-2 text-right">
                            <Link :href="issueRoutes.edit(issue.id)">
                                <Button variant="outline" size="sm">
                                    Edit
                                </Button>
                            </Link>
                        </TableCell>
                    </TableRow>

                    <TableRow v-if="issues.length === 0">
                        <TableCell colspan="5" class="text-muted-foreground h-24 text-center">
                            No issues yet.
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </div>
</template>
