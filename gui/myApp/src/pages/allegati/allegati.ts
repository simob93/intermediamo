import { Component } from '@angular/core';
import { 
  IonicPage, 
  NavController, 
  NavParams,
  LoadingController } from 'ionic-angular';
import { AllegatiProvider } from '../../providers/allegati/allegati';
import {Standard} from '../../standard/standard';



/**
 * Generated class for the AllegatiPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-allegati',
  templateUrl: 'allegati.html',
  providers:[AllegatiProvider]
})
export class AllegatiPage {
  listAllegati: any = [];
  path: string;
  constructor(
    public navCtrl: NavController, 
    public standard: Standard,
    public allegatiService: AllegatiProvider,
    public loading: LoadingController,
    public navParams: NavParams) {

  }
  /**
   * 
   * @param event 
   */
  onChange(event) {
      let file = event.target.files[0],
          c = new FileReader()

      c.onload = (e:Event) => {
        let { id } = this.navParams.get('valoriForm'); 
        let params = {
           idImmobile: id,
           nome: file.name,
           file: e.target['result'] //recupero il base 64
        }
        let loading = this.loading.create({
            content: 'Caricamento file in corso....'
        });
        //inizio il caricamento
        loading.present();
        this.allegatiService.upload(params).subscribe(response => {
            //arresto il carciamento
            loading.dismiss();
            this.standard.showErrorMessage(response['message']);
            this.getByContatto();
           
        })
      }
      c.readAsDataURL(file);

  }

  link(allegato) {
    let { id } = allegato; 
    this.allegatiService.link(id).subscribe(response => {
      window.open(response.data,'_blank')
  });
  }

  getByContatto() {
    let { id } = this.navParams.get('valoriForm');
    this.allegatiService.getByContatto(id).subscribe(response => {
        this.listAllegati = response.data;
    });
  }

  ionViewDidLoad() {
    this.getByContatto();
  }

}
