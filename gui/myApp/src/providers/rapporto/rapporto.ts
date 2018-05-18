import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Observable';
import * as constants from '../../standard/costants';
import { Http, RequestOptions, Headers } from '@angular/http';
/*
  Generated class for the RapportoProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class RapportoProvider {

  constructor(public http: Http) {
    console.log('Hello RapportoProvider Provider');
  }

  list(data: any) {
    //tocken 
    let headers = new Headers({ 'Authorization': 'Bearer '+ localStorage.getItem('token') });  
    let options = new RequestOptions({headers: headers, params: {data: data}});
    return this.http.get(constants.API_URL + 'rapporti/list', options).map(res => res.json());

  }

}
