interface User {
  id: number
  username: string
  email: string
  password: string
  created_at: string
  updated_at: string
}

interface Project {
  id: number
  name: string
  link: string
  description: string
  image: string
  created_at: string
  updated_at: string
  user: User
  votes: User[]
  owned: boolean
  voted: boolean
}
