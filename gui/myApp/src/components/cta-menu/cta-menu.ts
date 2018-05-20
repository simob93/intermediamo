import { 
  Component,
  Input,
  Output,
  EventEmitter
} from '@angular/core';

/**
 * Generated class for the CtaMenuComponent component.
 *
 * See https://angular.io/api/core/Component for more info on Angular
 * Components.
 */
@Component({
  selector: 'cta-menu',
  templateUrl: 'cta-menu.html'
})
export class CtaMenuComponent {
  @Input()
  descrizione: string;
  @Input()
  icon: string;
  @Input()
  screen: string;
  @Output('onClickCTA') onClickCTA : EventEmitter<any> = new EventEmitter();

  constructor() {
    
  }
  onClickButton() {
    this.onClickCTA.emit(this.screen);
  }

}
