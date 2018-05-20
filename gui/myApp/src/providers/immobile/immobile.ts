import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Observable';
import * as constants from '../../standard/costants';
import { Http, RequestOptions, Headers } from '@angular/http';

/*
  Generated class for the ImmobileProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/

export class ImmobileForm {
  id: number;
  dataAcquisto: Date = null;
  annoCostruzione: Date = null;
  dataRistrutturato: Date = null;
  costruitoDa: string = null;
  tipologia: string = null;
  mqNetti: number = null;
  mqComm: number = null;
  unitaTot: number = null;
  piano: number = null;
  totPiani: number = null;

  esposizione: string = null;
  giardino: boolean = null;
  mqGiardino: number = null;
  terrazzo: boolean = null;
  mqTerrazzo: number = null;
  numTerrazzo: number = null;
  balcone: boolean = null;
  numBalcone: number = null;
  mqBalcone: number = null;

  cannafumaria: boolean = null;
  cappotto: boolean = null;
  pannelliSolari: boolean = null;
  fotovoltaico: boolean = null;
  postoAuto: boolean = null;
  ingressoDisbrigo: boolean = null;
  cucinaAbitabile: boolean = null;
  cucinotto: boolean = null;
  soggiornoCottura: boolean = null;
  soggiorno: boolean = null;
  cameraMatrimoniale: boolean = null;
  cameretta: boolean = null;
  studio: boolean = null;
  ripostiglio: boolean = null;
  sottoTetto: boolean = null;
  bagni: boolean = null;
  stube: boolean = null;
  idContatto: number = null;

}

@Injectable()
export class ImmobileProvider {

  constructor(public http: Http) {

  }
  /**
   * 
   * @param object 
   */
  saveImmobile(object: ImmobileForm) {
       //validazione del token
    let headers = new Headers({ 'Authorization': 'Bearer '+ localStorage.getItem('token') });  
    let options = new RequestOptions({headers: headers});
    return this.http.post(constants.API_URL + 'immobile/save' , object, options).map(res => res.json());
  }
  /**
   * 
   * @param id 
   */
  getById(id: number) {
    //validazione del token
    let headers = new Headers({ 'Authorization': 'Bearer '+ localStorage.getItem('token') });  
    let options = new RequestOptions({headers: headers, params: {id}});
    
    return this.http.get(constants.API_URL + 'immobile/getById' , options).map(res => res.json()); 
}

}
