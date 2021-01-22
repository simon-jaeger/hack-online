import axios, {AxiosRequestConfig, AxiosResponse} from "axios"

type Endpoint =
  string
  | "ping"
  | "user"
  | "register"
  | "login"
  | "logout"
  | "project"

class Api {
  private _axios = axios.create()

  constructor() {
    this._axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest"
    this._axios.defaults.baseURL = "/api/"
  }

  async get<T = any>(url: Endpoint, config?: AxiosRequestConfig): Promise<T> {
    return (await this._axios.get(url, config)).data
  }

  async post<T = any>(url: Endpoint, data?: any, config?: AxiosRequestConfig): Promise<T> {
    return (await this._axios.post(url, data, config)).data
  }

  async patch<T = any>(url: Endpoint, data?: any, config?: AxiosRequestConfig): Promise<T> {
    return (await this._axios.patch(url, data, config)).data
  }

  async delete<T = any>(url: Endpoint, config?: AxiosRequestConfig): Promise<T> {
    return (await this._axios.delete(url, config)).data
  }

  async postBlob<T = any>(url: Endpoint, data: Object): Promise<T> {
    const formData = new FormData()
    for (const [key, value] of Object.entries(data)) {
      if (Array.isArray(value)) value.forEach(x => formData.append(key + "[]", x))
      else formData.append(key, value)
    }
    return (await this._axios.post(url, formData, {headers: {"Content-Type": "multipart/form-data"}})).data
  }
}

export default new Api()
