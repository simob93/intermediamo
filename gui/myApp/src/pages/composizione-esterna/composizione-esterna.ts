import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {Standard} from '../../standard/standard';

import { ViewChild } from '@angular/core';
import { Navbar } from 'ionic-angular';

/**
 * Generated class for the ComposizioneEsternaPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-composizione-esterna',
  templateUrl: 'composizione-esterna.html',
})
export class ComposizioneEsternaPage {

  @ViewChild(Navbar) navBar: Navbar;

  immobile: any = {};

  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams,
    public standard: Standard,
  ) {
      
  }

  changeCbox(event, name) { 

      if (!this.standard.isEmpty(name)) {
       
            let str = name[0].toUpperCase() + name.substr(1, name.lenght),
            nameNumero = 'num' + str,
            nameMq = 'mq' + str; 

          if (this.immobile[nameNumero] && !event.value) {
              this.immobile[nameNumero]  = null;
          }
          if (this.immobile[nameMq] && !event.value) {
              this.immobile[nameMq]  = null;
          }
      }
  }

  ionViewDidLoad() { 
    let valoriForm = this.navParams.get('valoriForm'),
        callbackfn = this.navParams.get('callbackfn');

    if (valoriForm) {
        this.immobile = valoriForm;
    }
  
    this.navBar.backButtonClick = (e:UIEvent)=>{
        if (callbackfn) {
            callbackfn(this.immobile);
        }
        this.navCtrl.pop();
    }
  }

}
