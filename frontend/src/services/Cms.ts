import axios, {AxiosRequestConfig, AxiosResponse} from "axios"

type Endpoint = string | "home" | "infos"

class Cms {
  private _axios = axios.create()

  constructor() {
    this._axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest"
    this._axios.defaults.baseURL = "/cockpit/api/singletons/get/"
  }

  async get<T = any>(url: Endpoint, config?: AxiosRequestConfig): Promise<T> {
    return (await this._axios.get(url, config)).data
  }
}

export default new Cms()
