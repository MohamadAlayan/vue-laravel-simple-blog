import {api} from "@/api";

export const post = {
    namespaced: true,
    state: {
        postsData: null,
        myPostsData: null,
    },
    getters: {
        getAll(state) {
            return state.postsData
        },
        getMyPosts(state) {
            return state.myPostsData
        },
    },
    mutations: {
        ADD_ALL_POSTS(state, postsData) {
            state.postsData = postsData
        },
        ADD_MY_POSTS(state, postsData) {
            state.myPostsData = postsData
        },
    },
    actions: {
        async getAll({commit, dispatch}, page = 1) {
            let response = await api.get('posts?page=' + page)
            if (response.data.status === "success") {
                commit("ADD_ALL_POSTS", response.data.content)
                return response.data.content
            }
        },
        async getMyPosts({commit, dispatch, rootGetters}, page = 1) {
            let currentUserId = rootGetters['auth/getUser'].id
            let response = await api.get('user/posts/' + currentUserId + '?page=' + page)
            if (response.data.status === "success") {
                commit("ADD_MY_POSTS", response.data.content)
                return response.data.content
            }
        },
        async getById({commit, dispatch}, id) {
            let response = await api.get('posts/' + id)
            if (response.data.status === "success") {
                return response.data.content
            }
        },

        async save({commit, dispatch}, post) {
            if (post.id !== 0) {
                await api.put('/posts/' + post.id, post)
            } else {
                await api.post('/posts', post)
            }
        },
        async delete({commit, dispatch}, id) {
            await api.delete('/posts/' + id)
        }

    }
}