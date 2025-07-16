import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
];

export default function Posts() {
    const {posts} = usePage().props;
    const {delete: destroy} = useForm();

    const destroyPost = (e: React.FormEvent, id: number) => {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this post?')) {
            destroy(route('posts.destroy', id));
        }
    };
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Posts" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <Link href={route('posts.create')} className="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Create Post
                </Link>
            </div>
            <div className="overflow-x-auto">
                <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                    <th scope="col" className="px-6 py-3">ID</th>
                    <th scope="col" className="px-6 py-3">Title</th>
                    <th scope="col" className="px-6 py-3">Body</th>
                    <th scope="col" className="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {posts.map(({id, title, body}) => (
                    <tr className="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td className="px-6 py-2 font-medium text-gray-900 dark:text-white">{id}</td>
                    <td className="px-6 py-2 text-gray-600 dark:text-gray-300">{title}</td>
                    <td className="px-6 py-2 text-gray-600 dark:text-gray-300">{body}</td>
                    <td className="px-6 py-2">
                        <form onSubmit={(e) => destroyPost(e, id)} className="flex items-center gap-2">
                            <Link
                            href={route('posts.edit', id)}
                            className="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800"
                            >
                            Edit
                            </Link>
                            <button
                            type="submit"
                            className="px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800"
                            >
                            Delete
                            </button>
                        </form>
                    </td>
                    </tr>
                    ))}
                </tbody>
                </table>
            </div>
            </div>
        </AppLayout>
    );
}
