import { CanActivateFn } from '@angular/router';

export const userGuard: CanActivateFn = (route, state) => {
  const str = localStorage.getItem("token") || "";
  if (str=="") return false; //no token   
  return true;
};
