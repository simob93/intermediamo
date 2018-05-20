import { NgModule } from '@angular/core';
import { StdCardComponent } from './std-card/std-card';
import { CardCheckComponent } from './card-check/card-check';
import { ListItemComponent } from './list-item/list-item';
import { CtaMenuComponent } from './cta-menu/cta-menu';
@NgModule({
	declarations: [StdCardComponent,
    CardCheckComponent,
    ListItemComponent,
    CtaMenuComponent],
	imports: [],
	exports: [StdCardComponent,
    CardCheckComponent,
    ListItemComponent,
    CtaMenuComponent]
})
export class ComponentsModule {}
