import { createStore } from "vuex";

export default createStore({
  state: {
    token: '',
    tokenableId: '',
  },
  getters: {
    getToken: (state) => state.token,
    getTokenableId: (state) => state.tokenableId, 
  },
  mutations: {
    setToken(state, token) {
      state.token = token;
    },
    clearToken(state) {
      state.token = null;
    },
    setTokenableId(state, tokenableId) { 
      state.tokenableId = tokenableId;
    },
  },
  actions: {
    setToken({ commit }, token) {
      commit('setToken', token);
    },
    clearToken({ commit }) {
      commit('clearToken');
    },
    setTokenableId({ commit }, tokenableId) {
      commit('setTokenableId', tokenableId);
    },
  },
  modules: {},
});
