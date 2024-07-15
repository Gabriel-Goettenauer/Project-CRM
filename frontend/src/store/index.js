import { createStore } from "vuex";

export default createStore({
  state: {
    token: '',
  },
  getters: {
    getToken: (state) => state.token,
  },
  mutations: {
    setToken(state, token) {
      state.token = token;
    },
    clearToken(state) {
      state.token = null;
    },
  },
  actions: {
    setToken({ commit }, token) {
      commit('setToken', token);
    },
    clearToken({ commit }) {
      commit('clearToken');
    },
  },
  modules: {},
});
