import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subscription } from 'rxjs';
import { ActorService } from 'src/app/service/actor-service';

@Component({
  selector: 'app-delete-actor',
  templateUrl: './delete-actor.component.html',
  styleUrls: ['./delete-actor.component.css']
})
export class DeleteActorComponent {
  private routeSub: Subscription;
  id: number;
  msg: any;
  processing: boolean;

  constructor(private route: ActivatedRoute, private actorService: ActorService) { }  

  ngOnInit() {
    this.processing = true;
    this.routeSub = this.route.params.subscribe(params => {
       this.id = params['id']
    });

    this.actorService.deleteActor(this.id).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
          this.processing = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false;
        }
      }
    );
  }

  ngOnDestroy() {
    this.routeSub.unsubscribe();
  }
}
