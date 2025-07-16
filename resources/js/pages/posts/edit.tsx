import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Textarea } from '@headlessui/react';
import { Head, Link, useForm, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Post',
        href: '/posts',
    },
];

export default function PostEdit() {
    const { post } = usePage().props;
    const { data, setData, errors, put} = useForm({
        title: post.title || '',
        body: post.body || '',
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('posts.update', post.id));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Post" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div>
                    <Link
                        href={route('posts.index')}
                        className="mb-4 inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                    >
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
                                className="flex h-15 w-full min-w-0 rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none selection:bg-primary selection:text-primary-foreground file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
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
