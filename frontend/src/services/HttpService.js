import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    "Content-type": "application/json",
  },
});
export const postUser = async(user) =>{
  return await HttpService.post('register',user)
}
export const postLogin = async(user) =>{
  return await HttpService.post('login',user)
}
export const getFunnels = async() =>{
  return await HttpService.get('funnels')
}
export const postFunnels = async(funnel) =>{
  return await HttpService.post('funnels')
}
export default HttpService;
