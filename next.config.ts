import type { NextConfig } from 'next';

const nextConfig: NextConfig = {
	distDir: 'out',
	exportPathMap: async function () {
		return {
			'/': { page: '/' },
		};
	},
};

export default nextConfig;
