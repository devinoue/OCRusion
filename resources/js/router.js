import Vue from 'vue'
import VueRouter from 'vue-router'
// ルート用のコンポーネントを読み込む


// Vuexと同様で最初にプラグインとして登録
Vue.use(VueRouter)

const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }


  const router = new VueRouter({
   
    routes:[
        { path: '/foo', component: Foo },
        { path: '/bar', component: Bar }
    ]
  })
// 生成したVueRouterインスタンスをエクスポート
export default router