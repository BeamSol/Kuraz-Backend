import InputError from '@/components/input-error';
import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Textarea } from '@headlessui/react';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { Head, Link, useForm } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Post Create',
        href: '/posts',
    },
];

export default function PostCreate() {

    const { data, setData, post, errors } = useForm({
        title: '',
        body: '',
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('posts.store'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Post Create" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <Link href={route('posts.index')} className="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Back
                </Link>
                <form onSubmit={submit} className="space-y-6">
                        <div className="grid gap-2">
                            <Label htmlFor="title">Title</Label>

                            <Input
                                id="title"
                                className="mt-1 block w-full"
                                value={data.title}
                                onChange={(e) => setData('title', e.target.value)}
                                autoComplete="title"
                                placeholder="Post title"
                            />

                            <InputError className="mt-2" message={errors.title} />
                        </div>
                        <div className="grid gap-2">
                            <Label htmlFor="body">Body</Label>

                            <Textarea
                                id="body"
                                className="border-input file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground flex h-15 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                value={data.body}
                                onChange={(e) => setData('body', e.target.value)}
                                autoComplete="body"
                                placeholder="Post body"
                            />

                            <InputError className="mt-2" message={errors.body} />
                        </div>
                        <div>
                            <Button>Save</Button>
                        </div>
                </form>
            </div>
            </div>
        </AppLayout>
    );
}
