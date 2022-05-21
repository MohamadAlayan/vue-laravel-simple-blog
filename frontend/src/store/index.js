import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import {auth} from './modules/auth';
import {post} from './modules/post';

// Create store
const store = createStore({
    modules: {
        auth,
        post
    },
    plugins: [createPersistedState({paths: ['auth']})]
});


export default store;