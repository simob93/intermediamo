import { Component, ViewChild } from '@angular/core';

import { 
  IonicPage, 
  NavController, 
  NavParams, 
  Slides } from 'ionic-angular';

import {
  ListItemComponent 
} from '../../components/list-item/list-item'

import { RapportoProvider } from '../../providers/rapporto/rapporto';

import * as moment from 'moment';
import 'moment/locale/it';
import { MenuImmobilePage } from '../menu-immobile/menu-immobile';

/**
 * Generated class for the RapportoPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-rapporto',
  templateUrl: 'rapporto.html',
})
export class RapportoPage {
  
  startDate: any;
  startDateFormatted: string;
  frequency: string = "today";
  data: any = []
  isFetching:boolean = false;

  @ViewChild(Slides) slides: Slides;

  constructor(
      public navCtrl: NavController, 
      public rapportoService: RapportoProvider,
      public navParams: NavParams
  ) {

  }
  /**
   * 
   * @param direction 
   */
  onClickIcon(direction: string) {
    let dayToAdd = direction === 'right' ? '+1' : '-1';
    this.startDate = moment(this.startDate).add(dayToAdd, 'days');
    this.startDateFormatted = this.startDate.format('DD MMMM YYYY');
    this.getList();

  }

  getList() {
    this.isFetching = true;
    this.rapportoService.list(moment(this.startDate).format('YYYY-MM-DDTHH:mm')).subscribe(response => {
        this.data = response['data'];
        this.isFetching = false;   
    });
  }
  /**
   * 
   * @param record 
   */
  onClickItem(record) {
    this.navCtrl.push(MenuImmobilePage, { record });
  }

  slideDidChange() {
    let currentIndex = this.slides.getActiveIndex();
    if (currentIndex != 1) 
      this.onClickIcon(this.slides.getActiveIndex() > 1 ? 'right' : 'left');
    this.slides.slideTo(1);
      
  }
  

  ionViewDidLoad() {
    //setto data in italiano
    moment.locale('it');
    this.startDate = moment(new Date());
    this.startDateFormatted = this.startDate.format('DD MMMM YYYY');
    this.getList();
  }

}
