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
} from '@/components/ui/card'
import { CalendarPlus } from 'lucide-vue-next';
import { dashboard } from '@/routes';
import projectRoutes from '@/routes/projects';

interface Project {
    id: number;
    title: string;
    description: string | null;
    created_at: string;
}

const props = withDefaults(
    defineProps<{
        projects?: Project[]
    }>(),
    {
        projects: () => [],
    }
)


defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

const formatDate = (dateString: string | number | Date) => {
  if (!dateString) return '';
  return new Date(dateString).toLocaleDateString('sv-SE');
};

</script>

<template>
    <Head title="Project Dashboard" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            <Card v-for="project in projects" :key="project.id">
                <CardHeader>
                    <CardTitle>
                        {{ project.title }}
                    </CardTitle>
                    <CardDescription>
                        {{ project.description }}
                    </CardDescription>
                </CardHeader>
                <CardContent class="flex justify-start gap-2">
                    <Link :href="projectRoutes.edit(project.id)">
                                <Button variant="outline" size="sm">
                                    Edit
                                </Button>
                    </Link>
                    <Link :href="projectRoutes.edit(project.id)">
                                <Button variant="outline" size="sm">
                                    View Issues
                                </Button>
                    </Link>
                </CardContent>
                <CardFooter class="gap-2">
                    <CalendarPlus/>
                    {{ formatDate(project.created_at) }}
                </CardFooter>
            </Card>

        </div>
    </div>
</template>
