import { Component, ViewChild } from '@angular/core';
import { IonicPage, NavController, NavParams, Navbar } from 'ionic-angular';

/**
 * Generated class for the ComposizioneInternaPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-composizione-interna',
  templateUrl: 'composizione-interna.html',
})
export class ComposizioneInternaPage {
  @ViewChild(Navbar) navBar: Navbar;
  immobile: any = {};
  ingressoDisbrigo: boolean = false;
  constructor(public navCtrl: NavController, public navParams: NavParams) {
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
    };
  }

}
