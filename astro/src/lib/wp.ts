const WP_BASE_URL = "http://wp-roots.localhost";

export interface WpRendered {
	rendered: string;
}

export interface Post {
	id: number;
	date: string;
	slug: string;
	link: string;
	title: WpRendered;
	content: WpRendered;
	excerpt: WpRendered;
}

export async function fetchLatestPost(): Promise<Post | null> {
	const res = await fetch(`${WP_BASE_URL}/wp-json/wp/v2/posts?per_page=1`);
	if (!res.ok) {
		throw new Error(`WP REST API request failed: ${res.status} ${res.statusText}`);
	}

	const posts: Post[] = await res.json();
	return posts[0] ?? null;
}
