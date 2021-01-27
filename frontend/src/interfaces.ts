interface User {
  id: number
  username: string
  email: string
  password: string
}

interface Project {
  id: number
  name: string
  link: string
  description: string
  image: string
  user: User
  votes: User[]
  owned: boolean
  voted: boolean
}
