<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { CalendarPlus } from 'lucide-vue-next';
import issueRoutes from '@/routes/issues';

interface Issue {
    id: number;
    title: string;
    description: string | null;
    project_id: number | null;
    status: string;
    created_at: string;
}

interface IssueProject {
    id: number;
    title: string;
    description: string;
    created_at: string;
    issues: Issue[];
}

const props = defineProps<{ project: IssueProject }>();

const formatDate = (dateString: string | number | Date) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString('sv-SE');
};
</script>

<template>
    <Head :title="`Issues for: ${props.project.title}`" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <Card v-for="issue in props.project.issues" :key="issue.id">
                <CardHeader>
                    <CardTitle>
                        {{ issue.title }}
                    </CardTitle>
                    <CardDescription>
                        {{ issue.description }}
                    </CardDescription>
                </CardHeader>
                <CardContent class="flex justify-start gap-2">
                    <Link :href="issueRoutes.edit(issue.id)">
                        <Button variant="outline" size="sm">Edit Issue</Button>
                    </Link>
                </CardContent>
                <CardFooter class="gap-2">
                    <CalendarPlus />
                    {{ formatDate(issue.created_at) }}
                </CardFooter>
            </Card>
        </div>
    </div>
</template>
