import {api} from "@/api";

export const auth = {
    namespaced: true,
    state: {
        user: null,
        token: undefined,
    },
    getters: {
        isAuthenticated: state => !!state.token,
        getUserToken(state) {
            return state.token
        },
        getUser(state) {
            return state.user
        },
    },
    mutations: {
        SAVE_USER(state, user) {
            state.user = user
        },
        SAVE_TOKEN(state, token) {
            state.token = token
        },
        LOGOUT(state) {
            state.token = null
            state.user = undefined
        },
    },
    actions: {
        async login({commit, dispatch}, credentials) {
            let loginResponse = await api.post('login', credentials)
            if (loginResponse.data.status === "success") {
                commit("SAVE_USER", loginResponse.data.content.user)
                commit("SAVE_TOKEN", loginResponse.data.content.token)
            }
        },
        async logout({commit, dispatch}) {
            await api.post('logout')
            commit("LOGOUT")
        },
    }
}