import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Observable';
import * as constants from '../../standard/costants';
import { Http, Headers, RequestOptions, Response } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class AllegatiProvider {

  constructor(public http: Http) {
    console.log('Hello AllegatiProvider Provider');
  }
  /**
   * 
   * @param object 
   */
  upload(object: any) {
    //validazione del token
    let headers = new Headers({ 'Authorization': 'Bearer '+ localStorage.getItem('token') });  
    let options = new RequestOptions({headers: headers});
    return this.http.post(constants.API_URL + 'allegati/upload' , object, options).map(res => res.json());
  }
  /**
   * 
   * @param id 
   */
  getByContatto(id: number) {
    //validazione del token
    let headers = new Headers({ 'Authorization': 'Bearer '+ localStorage.getItem('token') });  
    let options = new RequestOptions({headers: headers, params: {idImmobile: id}});
    return this.http.get(constants.API_URL + 'allegati/getByContatto', options).map(res => res.json());
  }
  /**
   * 
   * @param id 
   */
  link(id: number) {
    let headers = new Headers({ 'Authorization': 'Bearer '+ localStorage.getItem('token') });  
    let options = new RequestOptions({headers: headers, params: {id}});
    return this.http.get(constants.API_URL + 'allegati/linkById', options).map(res => res.json());
  }

}
