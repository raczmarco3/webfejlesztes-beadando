import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subscription } from 'rxjs';
import { MovieActorService } from 'src/app/service/movieactor-service';

@Component({
  selector: 'app-delete-movieactor',
  templateUrl: './delete-movieactor.component.html',
  styleUrls: ['./delete-movieactor.component.css']
})
export class DeleteMovieactorComponent {
  private routeSub: Subscription;
  id: number;
  msg: any;
  processing: boolean;

  constructor(private route: ActivatedRoute, private movieActorService: MovieActorService) { }

  ngOnInit() {
    this.processing = true;
    this.routeSub = this.route.params.subscribe(params => {
       this.id = params['id']
    });

    this.movieActorService.deleteMovieActor(this.id).subscribe(
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
