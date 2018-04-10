import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import {Observable} from 'rxjs/Observable';
import * as constants from '../../standard/costants';

import 'rxjs/add/operator/map'

/*
  Generated class for the AuthServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
export class User {
  username: string;
  password: string;
  
  constructor(password: string, username: string) {
    this.username = username;
    this.password = password;
  }
}

export class CustomResponse {
  data: string;
  message: any = [];
  success: boolean;

  constructor(data, message, success) {
    this.data = data;
    this.message = message;
    this.success = success;
  }
}

@Injectable()
export class AuthServiceProvider {
  currentUser: User;
  constructor(public http: HttpClient) {
  }
  public login(credentials:User):Observable<User> {
    return this.http.post<User>(constants.API_URL + 'auth/doLogin.php', credentials);
  }
 
  public register(credentials) {
   
  }
 
  public getUserInfo() : User {
    return this.currentUser;
  }
 
  public logout() {
    
  }

}
