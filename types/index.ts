// ~/types/index.ts

export { };

declare global {
  type Modal = "pc" | "chooseKratom" | "buy1" | "withdrawal" | "search" | "cart" | "signInSocial" | "signInEmail" | "resetPassword" | "changePassword" | "logInEmail" | "logInPassword" | "logOut"

  type ModalObject = {
    isShow: Boolean,
    data?: Object | Object[] | null
  }

  type Auth = {
    email: string | null,
    password: string | null,
    password_confirmation?: string | null,
    communication?: string | null,
    communication_number?: string | null,
    firstname?: string | null,
    lastname?: string | null,
  }

  type LoginForm = {
    email: string | null,
    password: string | null,
  }

  type Profile = {
    id: number | null,
    email: string,
    fullname: string,
    firstname: string | null,
    lastname: string | null,
    photo: string | null
  };

  type Feedback = {
    name: string,
    phone: string,
    email: string,
    text: string,
    type: string,
  };

  type changePassword = {
    token: string,
    email: string,
    password: string,
    password_confirmation: string
  }

  type Langs = "en" | "ru"
}