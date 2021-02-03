import Api from "@/services/Api"

class Auth {
  async init() {
    const isUser = await Api.get("user")
    localStorage.setItem("isUser", isUser)
  }

  async login(user: Partial<User>) {
    const isUser = await Api.post("login", user)
    localStorage.setItem("isUser", isUser)
  }

  async logout() {
    await Api.post("logout")
    localStorage.setItem("isUser", "")
  }

  async register(user: Partial<User>) {
    const isUser = await Api.post("register", user)
    localStorage.setItem("isUser", isUser)
  }

  check() {
    return localStorage.getItem('isUser')
  }

  guest() {
    return !this.check()
  }
}

export default new Auth()
