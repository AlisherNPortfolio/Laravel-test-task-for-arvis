import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

const routes = [
	{
		path: '/',
		name: 'home',
        redirect: {name: 'expenditure-index'},
		component: () => import('./../components/layouts/Home.vue'),
		children: [
			{
				path: 'expenditures',
				component: () => import('./../views/expenditures'),
                children: [
                    {
                        path: '',
                        name: 'expenditure-index',
                        component: () => import('./../views/expenditures/pages')
                    }
                ]
			},
            {
                path: 'measures',
                component: () => import('./../views/measures'),
                children: [
                    {
                        path: '',
                        name: 'measure-index',
                        component: () => import('./../views/measures/pages')
                    },
                    {
                        path: 'create',
                        name: 'measure-create',
                        component: () => import('./../views/measures/pages/add-edit')
                    },
                    {
                        path: ':id',
                        name: 'measure-update',
                        component: () => import('./../views/measures/pages/add-edit')
                    }
                ]
            },
            {
                path: 'products',
                component: () => import('./../views/products'),
                children: [
                    {
                        path: '',
                        name: 'product-index',
                        component: () => import('./../views/products/pages')
                    },
                    {
                        path: 'create',
                        name: 'product-create',
                        component: () => import('./../views/products/pages/add-edit')
                    },
                    {
                        path: ':id',
                        name: 'product-update',
                        component: () => import('./../views/products/pages/add-edit')
                    }
                ]
            }
		],
	}
];

const router = new VueRouter({
	mode: 'history',
	routes,
	scrollBehavior: () => ({
		y: 0,
	}),
});

export default router;
