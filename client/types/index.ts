// ~/types/index.ts

export { };

declare global {
  type Modal = "chooseKratom" | "buy1" | "withdrawal" | "search" | "cart" | "signInSocial" | "signInEmail" | "changePassword" | "logInEmail" | "logInPassword" | "logOut"

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

  type Langs = "en" | "ru"
}