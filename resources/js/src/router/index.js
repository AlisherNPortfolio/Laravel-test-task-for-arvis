import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

const routes = [
	{
		path: '/',
		name: 'home',
        redirect: {name: 'Expenditures'},
		component: () => import('./../components/layouts/Home.vue'),
		children: [
			{
				path: 'expenditures',
				name: 'Expenditures',
				component: () => import('./../views/expenditures'),
                children: [
                    {
                        path: '',
                        name: 'expenditure-index',
                        component: () => import('./../views/expenditures/pages/expenditures')
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
