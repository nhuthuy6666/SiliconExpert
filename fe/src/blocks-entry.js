// Blocks entry collector
// Collects all SCSS and JS files from blocks/*/assets/

// 1) Collect all SCSS files in blocks/*/assets/style.scss
// Vite will build and inject CSS into bundle
const styleModules = import.meta.glob('../../blocks/*/assets/style.scss', {
	eager: true,
});

// 2) Collect all JS files in blocks/*/assets/*.js
// With eager: true, scripts will run automatically when bundle loads
const scriptModules = import.meta.glob('../../blocks/*/assets/*.js', {
	eager: true,
});

// Log for debugging (can be removed in production)
if (import.meta.env.DEV) {
	console.log('Loaded block styles:', Object.keys(styleModules));
	console.log('Loaded block scripts:', Object.keys(scriptModules));
}
