import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { DatiCostruzionePage } from '../../pages/dati-costruzione/dati-costruzione';
import { DatiGeneraliPage } from '../../pages/dati-generali/dati-generali';
import { ComposizioneEsternaPage } from '../../pages/composizione-esterna/composizione-esterna';
import { ComposizioneInternaPage } from '../../pages/composizione-interna/composizione-interna';


/**
 * Generated class for the MenuImmobilePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-menu-immobile',
  templateUrl: 'menu-immobile.html',
})
export class MenuImmobilePage {
  object: {} = {};
  menuImmobile: Array<{titolo:String, page: any, objKey: any}>;  
  constructor(public navCtrl: NavController, public navParams: NavParams) {
  
}
/**
 * 
 */
clickBtnConfirm() {
  debugger;
}
/**
 * 
 * @param menuItem 
 */
  itemClick(menuItem) {
    
    

    this.navCtrl.push(menuItem.page, {
        valoriForm: this.object[menuItem.objKey],
        
        callbackfn: (params) => {
          this.object[menuItem.objKey] = {};
          Object.assign(this.object[menuItem.objKey], params)
        }
    });

  }

  ionViewDidLoad() {
    //menu "Scheda immobile"
    this.menuImmobile = [
        {
          titolo: 'Dati di costruzione',
          page: DatiCostruzionePage,
          objKey: 'datiCostruzione'
        },
        {
          titolo: 'Dati generali',
          page: DatiGeneraliPage,
          objKey: 'datiGenerali'
        },
        {
          titolo: 'Composizione esterna',
          page: ComposizioneEsternaPage,
          objKey: 'composizioneEsterna',
        },
        {
          titolo: 'Composizione interna',
          page: ComposizioneInternaPage,
          objKey: 'composizioneInterna'
        },
        {
          titolo: 'Riscaldamento e varie',
          page: null,
          objKey: null
        },
        {
          titolo: 'Vincoli',
          page: null,
          objKey: null
        }
    ]
  }

}
